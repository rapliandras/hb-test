<?php

namespace App\Service;

// This call was created for the sole reason that Simpsons API doesn't work if called from local env.
class FakeSimpsonsQuoteFetcherService implements SimpsonsQuoteFetcherServiceInterface
{
    public function fetch(int $count): array
    {
        return json_decode(match ($count) {
            1 => <<<JSON
[{"quote":"Thank you. Come again.","character":"Apu Nahasapeemapetilon","image":"https://cdn.glitch.com/3c3ffadc-3406-4440-bb95-d40ec8fcde72%2FApuNahasapeemapetilon.png?1497567511629","characterDirection":"Left"}]
JSON,
            2 => <<<JSON
[{"quote":"Doughnuts? I told you I don't like ethnic food","character":"Mr. Burns","image":"https://cdn.glitch.com/3c3ffadc-3406-4440-bb95-d40ec8fcde72%2FMrBurns.png?1497567512188","characterDirection":"Right"},{"quote":"Marriage is like a coffin and each kid is another nail.","character":"Homer Simpson","image":"https://cdn.glitch.com/3c3ffadc-3406-4440-bb95-d40ec8fcde72%2FHomerSimpson.png?1497567511939","characterDirection":"Right"}]
JSON,
            3 => <<<JSON
[{"quote":"I believe the children are the future... Unless we stop them now!","character":"Homer Simpson","image":"https://cdn.glitch.com/3c3ffadc-3406-4440-bb95-d40ec8fcde72%2FHomerSimpson.png?1497567511939","characterDirection":"Right"},{"quote":"You're turning me into a criminal when all I want to be is a petty thug.","character":"Bart Simpson","image":"https://cdn.glitch.com/3c3ffadc-3406-4440-bb95-d40ec8fcde72%2FBartSimpson.png?1497567511638","characterDirection":"Right"},{"quote":"Doughnuts? I told you I don't like ethnic food","character":"Mr. Burns","image":"https://cdn.glitch.com/3c3ffadc-3406-4440-bb95-d40ec8fcde72%2FMrBurns.png?1497567512188","characterDirection":"Right"}]
JSON,
            4 => <<<JSON
[{"quote":"That's where I saw the leprechaun...He told me to burn things.","character":"Ralph Wiggum","image":"https://cdn.glitch.com/3c3ffadc-3406-4440-bb95-d40ec8fcde72%2FRalphWiggum.png?1497567511523","characterDirection":"Left"},{"quote":"I used to be with it. But then they changed what it was. Now what I'm with isn't it, and what's it seems scary and wierd. It'll happen to you.","character":"Abe Simpson","image":"https://cdn.glitch.com/3c3ffadc-3406-4440-bb95-d40ec8fcde72%2FAbrahamSimpson.png?1497567511593","characterDirection":"Right"},{"quote":"Ah, be creative. Instead of making sandwhiches with bread, use Pop-Tarts. Instead of chewing gum, chew bacon.","character":"Dr. Nick","image":"https://cdn.glitch.com/3c3ffadc-3406-4440-bb95-d40ec8fcde72%2FNickRiviera.png?1497567511084","characterDirection":"Right"},{"quote":"In theory, Communism works! In theory.","character":"Homer Simpson","image":"https://cdn.glitch.com/3c3ffadc-3406-4440-bb95-d40ec8fcde72%2FHomerSimpson.png?1497567511939","characterDirection":"Right"}]
JSON,
            5 => <<<JSON
[{"quote":"My eyes! The goggles do nothing!","character":"Rainier Wolfcastle","image":"https://cdn.glitch.com/3c3ffadc-3406-4440-bb95-d40ec8fcde72%2FRainierWolfcastle.png?1497567511035","characterDirection":"Right"},{"quote":"For once maybe someone will call me \"sir\" without adding, \"You're making a scene.\"","character":"Homer Simpson","image":"https://cdn.glitch.com/3c3ffadc-3406-4440-bb95-d40ec8fcde72%2FHomerSimpson.png?1497567511939","characterDirection":"Right"},{"quote":"Why are you pleople avoiding me? Does my withered face remind you of the grim specter of death?","character":"Abe Simpson","image":"https://cdn.glitch.com/3c3ffadc-3406-4440-bb95-d40ec8fcde72%2FAbrahamSimpson.png?1497567511593","characterDirection":"Right"},{"quote":"Last night's \"Itchy & Scratchy\" was, without a doubt, the worst episode ever. Rest assured that I was on the Internet within minutes, registering my disgust throughout the world.","character":"Comic Book Guy","image":"https://cdn.glitch.com/3c3ffadc-3406-4440-bb95-d40ec8fcde72%2FComicBookGuy.png?1497567511970","characterDirection":"Right"},{"quote":"Oh Yeah!","character":"Duffman","image":"https://cdn.glitch.com/3c3ffadc-3406-4440-bb95-d40ec8fcde72%2FDuffman.png?1497567511709","characterDirection":"Left"}]
JSON,
        }, true);
    }
}