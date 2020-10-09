# FROM php:5.6.40-fpm
FROM php:7.4-fpm

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -qy \
    git \
    curl \
    libcurl4-openssl-dev \
    libpng-dev \
    libonig-dev \
    libssl-dev \
    libxml2-dev \
    openssl \
    python2.7 \
    zip \
    unzip

# Install node and deps for installing front end assets
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash - && \
    apt-get install -y nodejs && \
    npm i -g gulp@3.2.1 

# Install PHP extensions
RUN docker-php-ext-install mbstring exif pcntl bcmath gd > /dev/null
RUN pecl -q install mongodb && docker-php-ext-enable mongodb


# Clear cache 
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install dependencies  
# RUN composer install && npm i && gulp

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
