class FileValidationError extends Error {
    constructor(message) {
        super(message);
        this.name = 'FileValidationError';
        this.statusCode = 400;
    }
}

module.exports = FileValidationError;
