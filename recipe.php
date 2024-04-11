<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewpoint" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/Users/home/Desktop/course work/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,400;1,200;1,300;1,600&display=swap"
        rel="stylesheet">
    <style>
        /* General Styles */
        body {
            font-family: 'Josefin Sans', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        header {
            background-color: #343a40;
            color: #fff;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .nav-bar ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
        }

        .nav-bar ul li {
            margin-right: 20px;
        }

        .nav-bar ul li a {
            text-decoration: none;
            color: #fff;
        }

        .recipe {
            text-align: center;
            padding: 50px 0;
        }

        .recipe h2 {
            margin-bottom: 20px;
            font-size: 36px;
        }

        .box {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px;
            background-color: #fff;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .card img {
            width: 100%;
            border-radius: 10px 10px 0 0;
        }

        .content {
            padding: 20px;
        }

        .content h3 {
            margin-bottom: 10px;
            font-size: 24px;
        }

        .content p {
            margin-bottom: 20px;
        }

        .content button {
            background-color: #343a40;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .content button:hover {
            background-color: #212529;
        }

        footer {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 20px;
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        .social-icons {
            margin-bottom: 20px;
        }

        .social-icon {
            font-size: 24px;
            color: #fff;
            margin-right: 10px;
            text-decoration: none;
        }

        .social-icon:hover {
            color: #ccc;
        }
    </style>
    <title>Aj's Cusine</title>
</head>

<body>
    <header>
        <div class="logo">Aj's Cuisine</div>
        <div class="nav-bar">
            <ul>
                <li><a href="home.html">Home</a></li>
                <li><a href="aboutus.html">About</a></li>
                <li><a href="Recipes.html">Recipes</a></li>
                <li><a href="contact us .html">Contact</a></li>
            </ul>
        </div>
    </header>
    <div class="recipe">
        <h2>Featured Recipes</h2>
        <div class="box">
            <div class="card">
                <img src="assets/recipe 1.png" alt="">
                <div class="content">
                    <h3>Recipe 1</h3>
                    <p>Ghana jolloy.</p>
                    <p>Jollof Rice is one of the most common one-pot dishes in West Africa. 
                    It traditionally consists of jasmine or basmati rice, cooking oil, 
                    tomato, onion, curry powder, red pepper, garlic, ginger, and scotch bonnet. 
                    The spices used to enhance the flavors are salt, ground pepper seasoning 
                    such as cayenne, and other herby spices like nutmeg and dried thyme are used. Jollof can be enjoyed as is, but many people will compliment the dish with chicken, beef, fish, or even a salad.</p>
                    <button>View Recipe</button>
                </div>
            </div>
            <div class="card">
                <img src="assets/egusi.jpeg" alt="">
                <div class="content">
                    <h3>Egusi Soup recipe</h3>
                    <p>Egusi Soup recipe will show you how to make this popular West African soup with melon seeds..</p>
                    <p>This recipe will show you how to make Nigerian Egusi Soup, a popular West African soup made with melon seeds.

1 cup blended onions (about 3- 5 and fresh chilies, to taste)
4 cups egusi (melon seeds, ground or milled)
1⁄2 – 1 cup palm oil
2 teaspoons fresh Une (Iru, locust beans)
Salt (to taste)
Ground crayfish (to taste)
7– 8 cups stock
Cooked Meat & fish (quantity and variety to personal preference)
2 cups cut pumpkin leaves
1 cup waterleaf (cut)
3 tablespoons bitter leaf (washed)
EGUSI PASTE:
Prepare the egusi paste:
Blend egusi seeds and onion mixture. Set aside.
MAKE THE SOUP:
In a large pot, heat the palm oil on medium for a minute and then add the Une.
Slowly add the stock and set on low heat to simmer.
Scoop teaspoon size balls of the egusi paste mixture into the stock. Be sure to keep ball shape.
Leave to simmer for 20 – 30 minutes so the balls cook through.
Add the meat and fish and other bits which you’d like to use.
Add cut-up pumpkin leaves. 
Add the waterleaf.
Stir and put a lid on the pot and allow cook for 7–10 minutes, till the leaves wilt.
Add the bitter leaf.  Leave the lid off while the cooking finishes for another 5-10 minutes.

Stir, check seasoning and adjust accordingly.

Now you can sit back and enjoy your delicious Nigerian Egusi Soup!</p>
                    <button>View Recipe</button>
                </div>
            </div>
            
            <!-- More recipe cards here -->
        </div>
    </div>
    



</html>
