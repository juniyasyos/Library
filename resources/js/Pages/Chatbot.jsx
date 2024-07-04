import { useState, useEffect, useRef } from "react";

function ChatbotResponse({ content }) {
    const parseMarkdown = (text) => {
        const parsedText = text
            .replace(
                /## (.*?)\n/g,
                "<h2 class='text-2xl font-bold my-4'>$1</h2>"
            ) // Judul h2
            .replace(
                /### (.*?)\n/g,
                "<h3 class='text-xl font-semibold my-3'>$1</h3>"
            ) // Judul h3
            .replace(
                /\*\*([^*]+)\*\*/g,
                "<strong class='font-bold'>$1</strong>"
            ) // Bold
            .replace(/\*([^*]+)\*/g, "<em class='italic'>$1</em>") // Italic
            .replace(
                /([^:\n]+)\n((?:\s*[*-]\s[^\n]+\n)+)/g,
                (match, p1, p2) => {
                    const items = p2
                        .trim()
                        .split("\n")
                        .map(
                            (item) =>
                                `<li>${item.replace(/^\s*[*-]\s/, "")}</li>`
                        )
                        .join("");
                    return `<strong class='block mt-4 mb-2'>${p1}</strong><ul class='list-disc ml-6'>${items}</ul>`;
                }
            )
            .replace(
                /^\*\s(.*?):\s(.*)$/gm,
                "<strong class='block'>$1</strong><p class='ml-4'>$2</p>"
            ) // Bold items without colon
            .replace(/\n/g, "<br />"); // Baris baru

        return <div dangerouslySetInnerHTML={{ __html: parsedText }} />;
    };

    return (
        <div className="prose prose-sm max-w-none text-gray-800 space-y-3">
            {parseMarkdown(content)}
        </div>
    );
}

function Chatbot() {
    const [value, setValue] = useState("");
    const [error, setError] = useState(null);
    const [chatHistory, setChatHistory] = useState([]);

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

    const surprise = () => {
        const randomValue =
            surpriseOptions[Math.floor(Math.random() * surpriseOptions.length)];
        setValue(randomValue);
    };

    const getResponse = async () => {
        if (!value.trim()) {
            setError("Please enter a message.");
            return;
        }

        try {
            const options = {
                method: "POST",
                body: JSON.stringify({
                    history: chatHistory,
                    message: value,
                }),
                headers: {
                    "Content-Type": "application/json",
                },
            };

            const response = await fetch(
                "http://localhost:4000/gemini",
                options
            );

            if (!response.ok) {
                throw new Error("Network response was not ok.");
            }

            const data = await response.text();
            console.log(data);

            setChatHistory((oldChatHistory) => [
                ...oldChatHistory,
                { role: "user", parts: [{ text: value }] },
                { role: "model", parts: [{ text: data }] },
            ]);

            setValue("");
            setError(null); // Clear error after successful response
        } catch (error) {
            console.error("Error fetching response:", error);
            setError("Something went wrong. Please try again later.");
        }
    };

    useEffect(() => {
        if (value) {
            setError(null);
        }
    }, [value]);

    const clear = () => {
        setValue("");
        setError(null);
        setChatHistory([]);
    };

    const textareaRef = useRef(null);

    useEffect(() => {
        if (textareaRef.current) {
            textareaRef.current.style.height = "auto";
            textareaRef.current.style.height =
                textareaRef.current.scrollHeight + "px";
        }
    }, [value]);

    return (
        <div className="bg-white h-screen flex flex-col font-sans max-w-3xl mx-auto">
            <div className="flex-grow flex flex-col justify-end px-6 py-8">
                <div className="text-center mb-8">
                    <h1 className="text-3xl font-bold text-gray-800">
                        Ask Blackbox AI Anything
                    </h1>
                    <p className="text-gray-600 mt-2">
                        Trusted by Millions of Users & Fortune 500 Companies
                    </p>
                </div>

                <div className="flex-grow overflow-y-auto mb-4 px-4 flex flex-col items-center justify-center">
                    {chatHistory.length === 0 ? (
                        <button
                            onClick={surprise}
                            className="bg-blue-500 text-white px-6 py-3 rounded-lg font-medium"
                        >
                            Surprise Me
                        </button>
                    ) : (
                        // ... (tampilkan riwayat chat jika ada)
                        chatHistory.map((chatItem, index) => (
                            <div
                                key={index}
                                className={`mb-2 rounded-lg p-4 ${
                                    chatItem.role === "user"
                                        ? "bg-blue-100 text-blue-700 self-end" // Pesan user
                                        : "bg-gray-100 text-gray-800 self-start" // Pesan chatbot
                                }`}
                            >
                                <ChatbotResponse
                                    content={chatItem.parts[0].text}
                                />
                            </div>
                        ))
                    )}
                </div>

                <div className="bg-gray-100 rounded-lg p-4 shadow-md flex">
                    <textarea
                        ref={textareaRef}
                        value={value}
                        placeholder="Ask me anything..."
                        onChange={(e) => setValue(e.target.value)}
                        className="flex-grow px-4 py-2 rounded-lg bg-gray-200 focus:outline-none mr-2 resize-none overflow-hidden"
                        style={{ minHeight: "36px" }}
                    />
                    <button
                        onClick={getResponse}
                        disabled={!value.trim() || error !== null}
                        className="bg-blue-500 text-white px-6 py-2 rounded-lg font-medium mr-2"
                    >
                        Send
                    </button>

                    <button
                        onClick={clear}
                        className="bg-gray-400 text-white px-6 py-2 rounded-lg font-medium"
                    >
                        Clear
                    </button>
                </div>
                {error && (
                    <p className="text-red-600 mt-2 text-center">{error}</p>
                )}
            </div>
        </div>
    );
}

export default Chatbot;
