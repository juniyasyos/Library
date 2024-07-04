import express from "express";
import cors from "cors";
import dotenv from "dotenv";
import { GoogleGenerativeAI } from "@google/generative-ai";

dotenv.config();

const PORT = 4000;
const app = express();

app.use(cors());
app.use(express.json());

const genAI = new GoogleGenerativeAI(process.env.GEMINI_TOKEN_API_KEY);

app.post("/gemini", async (req, res) => {
    console.log(req.body.history);
    console.log(req.body.message);

    const model = genAI.getGenerativeModel({ model: "gemini-1.5-flash" });

    const history = req.body.history || [];

    const formattedHistory = history.map((item) => ({
        role: item.role,
        parts: [{ text: item.parts[0].text }],
    }));

    const chat = model.startChat({ history: formattedHistory });

    const msg = req.body.message;

    const result = await chat.sendMessage(msg);
    const response = await result.response;
    const text = response.text();
    console.log(text);
    res.send(text);
});

app.listen(PORT, () => console.log(`Listening on port ${PORT}`));
