## Bézout

1. `g = 0`; for each `x`: `g = gcd(g, x)`; if `g == 1`, return true.
2. Return `g == 1`.

`[12,5,7,23]` → true. `[3,6]` → gcd 3 → false.

Any subset works for the identity, and using all numbers gives the smallest gcd, so the whole array is enough.

Do not search for coefficients; the gcd decides it. Do not look for a pair of coprime numbers only; three numbers can have gcd 1 with no coprime pair, like 6, 10, 15.

Time: O(n log max)  
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
