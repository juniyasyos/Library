import { useState, useEffect, useRef } from "react";
import {
    ChakraProvider,
    Flex,
    Box,
    Heading,
    Text,
    Button,
    Textarea,
    useColorModeValue,
    Spinner,
} from "@chakra-ui/react";

// Parses markdown to HTML
const parseMarkdown = (text) => {
    const markdownRules = [
        [/##\s(.*?)\n/g, "<h2>$1</h2>"], // h2 heading
        [/###\s(.*?)\n/g, "<h3>$1</h3>"], // h3 heading
        [/\*\*(.*?)\*\*/g, "<strong>$1</strong>"], // Bold
        [/\*(.*?)\*/g, "<em>$1</em>"], // Italic
        [
            /([^:\n]+)\n((?:\s*[*-]\s[^\n]+\n)+)/g,
            (match, p1, p2) => {
                const items = p2
                    .trim()
                    .split("\n")
                    .map((item) => `<li>${item.replace(/^\s*[*-]\s/, "")}</li>`)
                    .join("");
                return `<p><strong>${p1}</strong></p><ul>${items}</ul>`;
            },
        ], // List
        [/^\*\s(.*?):\s(.*)$/gm, "<p><strong>$1</strong> $2</p>"], // Bold items without colon
        [/\n/g, "<br />"], // New line
    ];

    return {
        __html: markdownRules.reduce(
            (parsedText, [rule, replacement]) =>
                parsedText.replace(rule, replacement),
            text
        ),
    };
};

// Chatbot response component
const ChatbotResponse = ({ content }) => (
    <div
        className="prose prose-sm max-w-none text-gray-800 space-y-3"
        dangerouslySetInnerHTML={parseMarkdown(content)}
    />
);

const Chatbot = () => {
    const [userInput, setUserInput] = useState("");
    const [error, setError] = useState(null);
    const [chatHistory, setChatHistory] = useState([]);
    const [isTyping, setIsTyping] = useState(false);
    const textareaRef = useRef(null);

    // Surprise questions
    const surpriseOptions = [
        "Apa fungsi utama dari perpustakaan?",
        "Bagaimana cara mengakses perpustakaan digital?",
        "Apa perbedaan antara perpustakaan umum dan perpustakaan akademik?",
        "Apa saja manfaat membaca di perpustakaan?",
        "Bagaimana cara mencari buku di perpustakaan?",
        "Apa itu katalog perpustakaan?",
        "Bagaimana cara menjadi anggota perpustakaan?",
        "Apa itu ISBN dan bagaimana cara menemukannya di buku?",
        "Bagaimana cara meminjam buku dari perpustakaan?",
        "Apa saja peraturan umum di perpustakaan?",
        "Bagaimana cara mengembalikan buku perpustakaan?",
        "Apa yang harus dilakukan jika buku perpustakaan hilang?",
        "Apa itu perpustakaan keliling?",
        "Bagaimana cara mengajukan permintaan buku baru di perpustakaan?",
        "Apa itu layanan peminjaman antar perpustakaan?",
        "Bagaimana cara menemukan jurnal ilmiah di perpustakaan?",
        "Apa yang dimaksud dengan bibliografi?",
        "Apa itu perpustakaan digital dan apa keuntungannya?",
        "Bagaimana cara menggunakan sistem pencarian online di perpustakaan?",
        "Apa yang dimaksud dengan literasi informasi?",
        "Bagaimana cara merawat buku agar tahan lama?",
        "Apa itu Dewey Decimal Classification?",
        "Bagaimana cara menggunakan perpustakaan selama pandemi?",
        "Apa saja fasilitas yang biasanya ada di perpustakaan modern?",
        "Bagaimana cara mencari referensi untuk tugas kuliah di perpustakaan?",
        "Apa itu perpustakaan khusus?",
        "Bagaimana cara mengikuti acara atau workshop di perpustakaan?",
        "Apa itu perpustakaan anak dan apa manfaatnya?",
        "Bagaimana sejarah perpustakaan pertama di dunia?",
        "Apa saja layanan tambahan yang biasanya disediakan oleh perpustakaan?",
    ];

    // Selects a random surprise question
    const handleSurprise = () => {
        const randomIndex = Math.floor(Math.random() * surpriseOptions.length);
        setUserInput(surpriseOptions[randomIndex]);
    };

    // Fetches response from server with typing indicator
    const getResponse = async () => {
        const message = userInput.trim();

        if (!message) {
            setError("Please enter a message.");
            return;
        }

        setError(null);
        setChatHistory((prevHistory) => [
            ...prevHistory,
            { role: "user", parts: [{ text: message }] },
        ]);
        setUserInput("");
        setIsTyping(true);

        try {
            const response = await fetch("http://localhost:4100/gemini", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ history: chatHistory, message }),
            });

            if (!response.ok) {
                throw new Error("Network response error.");
            }

            const data = await response.text();

            setChatHistory((prevHistory) => [
                ...prevHistory,
                { role: "model", parts: [{ text: data }] },
            ]);
        } catch (error) {
            console.error("Error fetching response:", error);
            setError("Something went wrong. Please try again later.");
        } finally {
            setIsTyping(false);
        }
    };

    // Clears error on input change
    useEffect(() => {
        if (userInput) {
            setError(null);
        }
    }, [userInput]);

    // Dynamically adjusts textarea height
    useEffect(() => {
        textareaRef.current.style.height = `${textareaRef.current.scrollHeight}px`;
    }, [userInput, chatHistory]);

    // Clears input and chat history
    const clearChat = () => {
        setUserInput("");
        setError(null);
        setChatHistory([]);
    };

    return (
        <ChakraProvider>
            <Flex
                bg="white"
                h="100vh"
                direction="column"
                fontSans="true"
                maxW="3xl"
                mx="auto"
            >
                {/* Header */}
                <Box
                    flexGrow={1}
                    flexDirection="column"
                    justifyContent="end"
                    px={6}
                    py={8}
                >
                    <Box textAlign="center" mb={8}>
                        <Heading
                            as="h1"
                            size="3xl"
                            fontWeight="bold"
                            color="gray.800"
                        >
                            Ask Library AI Anything
                        </Heading>
                        <Text color="gray.600" mt={2}>
                            Trusted by Millions of Student & Fortune Bachelor
                            Companies
                        </Text>
                    </Box>

                    {/* Chat history */}
                    <Flex
                        flexGrow={1}
                        overflowY="auto"
                        mb={20}
                        px={4}
                        flexDirection="column"
                        alignItems="center"
                        justifyContent="center"
                    >
                        {chatHistory.length === 0 ? (
                            <Button
                                bg="blue.500"
                                color="white"
                                px={6}
                                py={3}
                                borderRadius="lg"
                                fontWeight="medium"
                                onClick={handleSurprise}
                                _hover={{ bg: "blue.600" }}
                            >
                                Surprise Me
                            </Button>
                        ) : (
                            chatHistory.map((chatItem, index) => (
                                <Box
                                    key={index}
                                    mb={2}
                                    p={4}
                                    borderRadius="lg"
                                    bg={
                                        chatItem.role === "user"
                                            ? "blue.100"
                                            : useColorModeValue(
                                                  "gray.100",
                                                  "gray.700"
                                              )
                                    }
                                    textAlign={
                                        chatItem.role === "user"
                                            ? "right"
                                            : "left"
                                    }
                                    alignSelf={
                                        chatItem.role === "user"
                                            ? "flex-end"
                                            : "flex-start"
                                    }
                                >
                                    <ChatbotResponse
                                        content={chatItem.parts[0].text}
                                    />
                                </Box>
                            ))
                        )}

                        {/* Typing indicator */}
                        {isTyping && (
                            <Box
                                mb={2}
                                p={4}
                                borderRadius="lg"
                                bg={useColorModeValue("gray.100", "gray.700")}
                                textAlign="left"
                                alignSelf="flex-start"
                            >
                                <Spinner size="sm" color="blue.500" />
                                <Text
                                    ml={2}
                                    as="span"
                                    fontSize="sm"
                                    color="gray.600"
                                >
                                    Library AI is typing...
                                </Text>
                            </Box>
                        )}
                    </Flex>
                </Box>

                {/* Input and buttons */}
                <Box
                    position="fixed"
                    bottom={0}
                    left={0}
                    w="full"
                    px={6}
                >
                    <Box
                        bg="gray.100"
                        borderRadius="lg"
                        p={4}
                        shadow="md"
                        display="flex"
                    >
                        <Textarea
                            ref={textareaRef}
                            value={userInput}
                            placeholder="Ask me anything..."
                            onChange={(e) => setUserInput(e.target.value)}
                            flexGrow={1}
                            px={4}
                            py={2}
                            borderRadius="lg"
                            bg="gray.200"
                            _focus={{ outline: "none" }}
                            resize="none"
                            overflow="hidden"
                            minHeight="36px"
                            mr={2}
                        />
                        <Button
                            onClick={getResponse}
                            disabled={!userInput.trim() || error !== null}
                            bg="blue.500"
                            color="white"
                            px={6}
                            py={2}
                            borderRadius="lg"
                            fontWeight="medium"
                            mr={2}
                            _hover={{ bg: "blue.600" }}
                        >
                            Send
                        </Button>
                        <Button
                            onClick={clearChat}
                            bg="gray.400"
                            color="white"
                            px={6}
                            py={2}
                            borderRadius="lg"
                            fontWeight="medium"
                            _hover={{ bg: "gray.500" }}
                        >
                            Clear
                        </Button>
                    </Box>
                </Box>

                {error && (
                    <Text color="red.600" mt={2} textAlign="center">
                        {error}
                    </Text>
                )}
            </Flex>
        </ChakraProvider>
    );
};

export default Chatbot;
