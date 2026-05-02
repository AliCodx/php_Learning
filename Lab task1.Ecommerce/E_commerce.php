<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Shop</title>
    <style>
        :root {
            --bg: #f6f1e8;
            --surface: #fffaf2;
            --card: #ffffff;
            --text: #1f1f1f;
            --muted: #6d6259;
            --accent: #c56b2d;
            --accent-dark: #9c4f1b;
            --border: #eadbc8;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Georgia, "Times New Roman", serif;
            background: linear-gradient(180deg, #f8f4ec 0%, #efe2cf 100%);
            color: var(--text);
            line-height: 1.6;
        }

        .container {
            width: min(1100px, 92%);
            margin: 0 auto;
        }

        header {
            padding: 24px 0;
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
        }

        .logo {
            font-size: 1.7rem;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .nav-links {
            display: flex;
            gap: 20px;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text);
            font-size: 0.95rem;
        }

        .hero {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 32px;
            align-items: center;
            padding: 42px 0 56px;
        }

        .hero-text h1 {
            font-size: clamp(2.2rem, 5vw, 4.4rem);
            line-height: 1.05;
            margin-bottom: 18px;
        }

        .hero-text p {
            color: var(--muted);
            max-width: 540px;
            margin-bottom: 24px;
        }

        .btn {
            display: inline-block;
            background: var(--accent);
            color: #fff;
            text-decoration: none;
            padding: 12px 22px;
            border-radius: 999px;
            font-size: 0.95rem;
            transition: background 0.2s ease, transform 0.2s ease;
        }

        .btn:hover {
            background: var(--accent-dark);
            transform: translateY(-2px);
        }

        .hero-card {
            background: rgba(255, 250, 242, 0.85);
            border: 1px solid var(--border);
            border-radius: 28px;
            padding: 28px;
            box-shadow: 0 18px 40px rgba(88, 61, 34, 0.08);
        }

        .hero-image {
            height: 340px;
            border-radius: 22px;
            background: linear-gradient(135deg, #d6884e, #f3d1aa);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff8f1;
            font-size: 2rem;
            text-align: center;
            padding: 20px;
        }

        .section-title {
            font-size: 2rem;
            margin-bottom: 24px;
        }

        .products {
            padding: 24px 0 70px;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }

        .product-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 22px;
            padding: 18px;
            box-shadow: 0 12px 30px rgba(67, 49, 28, 0.06);
        }

        .product-image {
            height: 180px;
            border-radius: 16px;
            margin-bottom: 16px;
            background: linear-gradient(135deg, #f0c995, #d17c3d);
        }

        .product-card h3 {
            margin-bottom: 8px;
            font-size: 1.2rem;
        }

        .product-card p {
            color: var(--muted);
            font-size: 0.95rem;
            margin-bottom: 14px;
        }

        .product-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .price {
            font-weight: bold;
            font-size: 1.05rem;
        }

        .mini-btn {
            border: none;
            background: #1f1f1f;
            color: #fff;
            padding: 10px 16px;
            border-radius: 999px;
            cursor: pointer;
        }

        .mini-btn:hover {
            background: #000;
        }

        footer {
            padding: 24px 0 40px;
            text-align: center;
            color: var(--muted);
            font-size: 0.9rem;
        }

        @media (max-width: 860px) {
            .hero,
            .product-grid {
                grid-template-columns: 1fr;
            }

            .nav {
                flex-direction: column;
            }
        }

        @media (max-width: 560px) {
            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }

            .hero-image {
                height: 240px;
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <header class="container">
        <nav class="nav">
            <div class="logo">Simple Shop</div>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#products">Products</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <section class="hero" id="home">
            <div class="hero-text">
                <h1>Simple style for everyday shopping.</h1>
                <p>Discover a clean and modern collection of fashion, accessories, and essentials designed for daily life.</p>
                <a href="#products" class="btn">Shop Now</a>
            </div>
            <div class="hero-card">
                <div class="hero-image">New Season Collection</div>
            </div>
        </section>

        <section class="products" id="products">
            <h2 class="section-title">Featured Products</h2>
            <div class="product-grid">
                <article class="product-card">
                    <div class="product-image"></div>
                    <h3>Classic Backpack</h3>
                    <p>Durable and stylish bag for school, work, or travel.</p>
                    <div class="product-footer">
                        <span class="price">$39</span>
                        <button class="mini-btn">Buy Now</button>
                    </div>
                </article>

                <article class="product-card">
                    <div class="product-image"></div>
                    <h3>Casual Sneakers</h3>
                    <p>Comfortable sneakers with a minimal design for daily wear.</p>
                    <div class="product-footer">
                        <span class="price">$54</span>
                        <button class="mini-btn">Buy Now</button>
                    </div>
                </article>

                <article class="product-card">
                    <div class="product-image"></div>
                    <h3>Smart Watch</h3>
                    <p>Track your day with a sleek watch built for convenience.</p>
                    <div class="product-footer">
                        <span class="price">$89</span>
                        <button class="mini-btn">Buy Now</button>
                    </div>
                </article>
            </div>
        </section>
    </main>

    <footer id="contact">
        <div class="container">
            <p id="about">Simple Shop | Fresh products, simple design, better shopping.</p>
        </div>
    </footer>
</body>
</html>
