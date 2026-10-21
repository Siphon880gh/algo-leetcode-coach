## Running fraction

Keep `num = 0`, `den = 1`. Scan the string:

1. Read an optional sign, the numerator digits, `/`, and the denominator digits.
2. Add `a/b`: `num = num · b + a · den`, `den = den · b`.
3. Divide both by `g = gcd(|num|, den)`.

At the end, return `f"{num}/{den}"`. Zero comes out as `0/1`, because `gcd(0, den) = den`.

All denominators are 1 to 10 and there are at most 10 fractions, so the numbers stay small. Using `lcm(den, b)` as the new denominator keeps them even smaller.

Do not drop the sign of the first fraction; it may be negative too. Do not print a whole number as `2`; the format is always `a/b`, so it is `2/1`.

Time: O(n)  
Space: O(1)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
