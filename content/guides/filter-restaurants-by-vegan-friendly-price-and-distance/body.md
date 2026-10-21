## Filter, then two-key sort

1. Keep `[id, rating, vegan, price, dist]` when `(vegan or not veganFriendly)`, `price ≤ maxPrice`, and `dist ≤ maxDistance`.
2. Sort by `(−rating, −id)`; return the ids.

With the example list: vegan, 50, 10 → `[3,1,5]`; no vegan filter, 50, 10 → `[4,3,2,1,5]`; no vegan filter, 30, 3 → `[4,5]`.

Do not require `vegan = 0` when `veganFriendly = 0`; it means no filter. Do not break rating ties by ascending id; higher ids come first.

Time: O(n log n)  
Space: O(n)

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
