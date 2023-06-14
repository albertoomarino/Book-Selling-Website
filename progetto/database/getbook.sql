-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 10, 2023 alle 15:11
-- Versione del server: 10.4.24-MariaDB
-- Versione PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `getbook`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `cart`
--

CREATE TABLE `cart` (
  `title` varchar(60) NOT NULL,
  `username` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `cart`
--

INSERT INTO `cart` (`title`, `username`) VALUES
('Fairy Tale', 'mariorossi'),
('Fallen', 'albertomarino'),
('Fallen', 'carolinabianchi'),
('Fallen', 'mariorossi'),
('King', 'mariorossi'),
('La custode dei segreti', 'carolinabianchi'),
('La custode dei segreti', 'mariorossi'),
('La portalettere', 'albertomarino'),
('Luce della notte', 'albertomarino'),
('Spare il minore', 'carolinabianchi');

-- --------------------------------------------------------

--
-- Struttura della tabella `products`
--

CREATE TABLE `products` (
  `title` varchar(60) NOT NULL,
  `author` varchar(60) NOT NULL,
  `price` double NOT NULL,
  `publisher` varchar(60) NOT NULL,
  `plot` varchar(900) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `products`
--

INSERT INTO `products` (`title`, `author`, `price`, `publisher`, `plot`, `image`) VALUES
('Fairy Tale', 'Stephen King', 20.8, 'Sperling Kupfer', 'Charlie Reade is a seventeen year old like many others, discreet at school, excellent in baseball and football. But he carries a burden too great for his age. His mother died in a car accident when he was seven years old and his father succumbed to alcohol due to pain. Since then, Charlie has had to learn to look after both of them. One day, he comes across an old man - Howard Bowditch - who lives in seclusion with his dog Radar in a large house on top of a hill, known in the neighborhood as \"Psycho\'s House\". There\'s a shed in the back yard, always locked, that makes strange noises. Charlie rescues Howard after an injury, gaining his trust, and takes care of Radar, who becomes best friends with him.', '../imgBooks/Fairy Tale.jpg'),
('Fallen', 'Lauren Kate', 19.99, 'Rizzoli', 'An instant is enough to upset an existence. To change that of Lucinda, seventeen years old, was the accident in which a close friend of hers died. And she has seen the dark shadows that have haunted her since she was a child gather again. Looked upon with suspicion by the police and by those who hold her responsible for the death of her friend, Luce - as everyone calls her - is forced to enter a correctional institution. No contact with the outside world, surveillance cameras, boys and girls with dark and disturbed pasts are all she finds at Sword & Cross school. And then Daniel appears, and Luce suddenly no longer knows what is true and what is not: her heart tells her that she has already met him, but only rare flashes of too brief memories light up in her mind to be true.', '../imgBooks/Fallen.jpg'),
('King', 'Davide Chinellato', 19.5, 'Libreria Pienogiorno', 'Even if LeBron himself will never say it, even if for him the best will always be Air Jordan, a former NBA star like Isiah Thomas has no doubts: it is King James the Goat, the greatest ever. «Because we have never had a player who manages to combine dominance on the parquet with everything else like LeBron. For the first aspect there are the statistics, and the numbers never lie: no one has had his surrender and his consistency in every aspect of the game. Just as no one has done what he did for communities in difficulty\". For all these reasons LeBron James is unique. The child abandoned by his father and with a mother still sixteen, who spent his difficult childhood (\"I saw everything: drugs, murders; it was crazy\") wandering between sofas and rented rooms, until being taken into foster care by the coach of the neighborhood football team.', '../imgBooks/King.jpg'),
('La custode dei segreti', 'Sally Page', 9.99, 'Newton Compton Editori', 'Everyone has a story to tell... Janice cleans people\'s homes by trade: she has a front row seat to discreetly observe their loves, worries, joys and even the most shameful secrets. It is as if, in handing her the house keys to allow her to come in to clean, people also entrust her with their most private and hidden sides. And so Janice started collecting stories. She small and large events of real life, which she keeps with care. She knows how to look, listen, grasp every detail. Janice knows that each of us has a story to tell. And perhaps it might be time to share hers.', '../imgBooks/La custode dei segreti.jpg'),
('La portalettere', 'Francesca Giannone', 18.99, 'Nord', 'Salento, June 1934. In Lizzanello, a village of a few thousand souls, a bus stops in the main square. A couple comes down: he, Carlo, is a son of the South, and is happy to be back home; she, Anna, her wife, is as beautiful as a Greek statue, but sad and worried: what life awaits her in that unknown land? Even thirty years after that day, Anna will remain for everyone \"the foreigner\", the one who came from the North, the different one, who doesn\'t go to church, who always says what she thinks. And Anna, proud and angular, will never bend to the unwritten laws that imprison the women of the South. She will succeed also thanks to the love that binds her to her husband, a love whose strength will be painfully clear to Carlo\'s older brother, Antonio , who fell in love with Anna the instant he saw her.', '../imgBooks/La portalettere.jpg'),
('Le amiche del cuore', 'Mariah Stewart', 18.9, 'Libreria Pienogiorno', 'Maggie, Emma and Liddy grew up together in Wyndham Beach, Massachusetts. They have always been inseparable friends: together they spent whole days confiding in joys and sorrows, they exchanged clothes and lipsticks, they sang their hearts out at concerts, overcame difficult moments supporting each other, each knowing they can always find the other\'s hand not far away . Together, like waves of the same sea. Yet there is a secret that Maggie has never revealed to anyone, not even them. It goes back so many years before her, when she was very young and she could hardly tell herself. Simply, to survive, she had had to go further: new city, job, marriage, children.', '../imgBooks/Le amiche del cuore.jpg'),
('Luce della notte', 'Ilaria Tuti', 9.99, 'TEA', 'Chiara had a dream. And she was very scared. She sings and counts, she told herself in her dream, but the dark didn\'t want to leave. Thus, Chiara relied on the invisible light of the night to move her steps in the woods. But what she found while digging at the roots of the tree shocked her. Because maybe it wasn\'t really a dream. Maybe it was a scary reality. It\'s almost Christmas, the day Chiara will be nine years old. Indeed, the night: because the little girl does not see the light of the sun, she no longer knows how long. It takes a big heart to help her little heart stop shaking. This is why, a few days after the closure of a very tiring and dangerous case and the discovery of something that she will have to keep to herself, Teresa Battaglia doesn\'t hesitate to get involved. Perhaps because, despite everything, a child\'s heart still beats in her.', '../imgBooks/Luce della notte.jpg'),
('Spare il minore', 'Prince Harry', 23.75, 'Mondadori', 'It was one of the most heartbreaking images of the twentieth century: two little boys, two princes, following their mother\'s coffin under the pained and horrified eyes of the whole world. As the funeral of Diana, Princess of Wales was celebrated, billions of people wondered what thoughts crowded the princes\' minds, what emotions passed through their hearts, and how their lives would unravel from that moment on. Finally Harry tells the story of him.', '../imgBooks/Spare il minore.jpg');

-- --------------------------------------------------------

--
-- Struttura della tabella `reviews`
--

CREATE TABLE `reviews` (
  `username` varchar(16) NOT NULL,
  `title` varchar(60) NOT NULL,
  `text` varchar(900) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `reviews`
--

INSERT INTO `reviews` (`username`, `title`, `text`) VALUES
('albertomarino', 'Fallen', 'I loved this saga and the third book especially. I would even give it a 5 star but a lot of things were left unfinished. I very much hope there is another book.'),
('albertomarino', 'Spare il minore', 'Una piacevole lettura che, contrariamente alle voci che circolano intorno ad essa, non si è rivelata affatto banale. Un viaggio nella quotidianità di uno dei personaggi più discusso della monarchia inglese, soprattutto negli ultimi tempi. La consiglio a chi vuole un punto di vista diverso, dall\'interno, di buona parte di ciò che siamo stati abituati a sentire su di lui e la Royal Family.'),
('carolinabianchi', 'King', 'Curious and interesting!'),
('carolinabianchi', 'Spare il minore', 'A pleasant read which, contrary to the rumors circulating around it, has not proved trivial at all. A journey into the everyday life of one of the most discussed characters of the English monarchy, especially in recent times. I recommend it to anyone who wants a different point of view, from the inside, of much of what we\'ve been used to hearing about him and the Royal Family.'),
('mariorossi', 'Fallen', 'First book. Bought because the cover really appealed to me. I think it\'s one of the most beautiful love stories in the universe. I love Lauren Kate is one of my favorite foreign writers.'),
('mariorossi', 'Le amiche del cuore', 'Well written, flowing with a plot that grabs you from the start, even if the first part might seem a bit obvious!');

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `username` varchar(16) NOT NULL,
  `name` varchar(32) NOT NULL,
  `surname` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `role` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`username`, `name`, `surname`, `email`, `password`, `role`) VALUES
('albertomarino', 'Alberto', 'Marino', 'alberto.marino@gmail.com', '4b8365fe28f0abe4745d6367e6dea416', 'admin'),
('carolinabianchi', 'Carolina', 'Bianchi', 'carolinabianchi@gmail.com', 'f82a6390f8f81fbe8ffd2e7769234c14', 'user'),
('mariorossi', 'Mario', 'Rossi', 'mariorossi@gmail.com', 'c825c06c07a41b30a5e9812b251b61e9', 'user');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`title`,`username`),
  ADD KEY `cart-users` (`username`);

--
-- Indici per le tabelle `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`title`);

--
-- Indici per le tabelle `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`username`,`title`),
  ADD KEY `title` (`title`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart-products` FOREIGN KEY (`title`) REFERENCES `products` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart-users` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`title`) REFERENCES `products` (`title`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
