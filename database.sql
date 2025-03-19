CREATE TABLE vote (
    id INT AUTO_INCREMENT PRIMARY KEY,
    option_name VARCHAR(50) NOT NULL,
    vote_count INT DEFAULT 0
);

-- Insert initial vote options
INSERT INTO vote (option_name, vote_count) VALUES
('J\'aime bien', 0),
('J\'aime moyen', 0),
('J\'aime pas', 0);
