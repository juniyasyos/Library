import * as React from "react";
import {
    ChakraProvider,
    Flex,
    Box,
    Container,
    Heading,
} from "@chakra-ui/react";

export default function ChakraUi ({ children }) {
    return (
        <ChakraProvider>
            <Flex minHeight="100vh" direction="column">
                <Box bg="teal.500" color="white" p={4}>
                    <Container maxW="xl">
                        <Heading as="h1" size="lg">
                            Aplikasi Saya
                        </Heading>
                    </Container>
                </Box>

                {/* Konten Utama */}
                <Box flex="1" p={4}>
                    <Container maxW="xl">{children}</Container>
                </Box>

                {/* Footer */}
                <Box bg="gray.200" p={4} textAlign="center">
                    © {new Date().getFullYear()} Hak Cipta Dilindungi
                </Box>
            </Flex>
        </ChakraProvider>
    );
}
