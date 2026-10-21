## Expected vs actual

1. Count each height in `cnt[1..100]`.
2. Walk `heights` with a pointer `h` into the counts: skip `h` while `cnt[h] == 0`; if `heights[i] != h`, add 1; then `cnt[h] −= 1`.
3. Return the count.

Sorting a copy with the library sort and comparing works too, in O(n log n).

Do not count inversions or swaps; the question only asks how many positions are out of place. Do not sort `heights` in place before comparing; you need the original order.

Time: O(n + 100)  
Space: O(100)

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
