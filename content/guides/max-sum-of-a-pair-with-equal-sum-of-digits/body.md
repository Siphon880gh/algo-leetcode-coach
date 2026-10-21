## One pass with a map

1. `best = −1`, `top = {}`.
2. For each `x`: `s` = digit sum of `x`. If `s ∈ top`, `best = max(best, top[s] + x)`. Then `top[s] = max(top[s], x)`.
3. Return `best`.

Examples → 54, −1. Checked against every pair on 300 random arrays.

The best pair in a group is its two largest numbers, and pairing each number with the largest before it finds them. Digit sums are at most 81 for values up to 10^9, so an array of 82 works as the map. Sums reach 2 · 10^9, just under the signed 32-bit limit of 2,147,483,647, so 32-bit still fits, though 64-bit leaves headroom.

Time: O(n · digits)  
Space: O(82)

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
