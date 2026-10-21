## Sort positions, not values

Make the index list `0..n−1` and sort it by `score` descending. Walking that list, position `p` (0-based) holds the athlete in place `p + 1`. Write the medal or `str(p + 1)` into `ans[index]`. Sorting indices keeps the link back to the original order.

A max-heap of `(score, index)` popped `n` times gives the same order. Since scores are at most 1e6, a counting array over scores also works.

Rank Transform of an Array (1331) gives equal values equal ranks; here scores are unique.

Do not sort `score` itself and lose the original positions. Do not give number strings to the top three.

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
