CREATE TABLE IF NOT EXISTS todos (
    id VARCHAR(32) PRIMARY KEY,
    title VARCHAR(512) NOT NULL,
    completed VARCHAR(1) NOT NULL DEFAULT 'N',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NULL DEFAULT NULL,
	completed_at DATETIME NULL DEFAULT NULL
);

INSERT INTO todos (id, title) VALUES ('123', 'Wake up');
INSERT INTO todos (id, title) VALUES ('456', 'Build something amazing');
