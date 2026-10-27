## Two maps

1. `checkIn(id, s, t)`: `open[id] = (s, t)`.
2. `checkOut(id, e, t)`: pop `(s, t0)`; `route[(s, e)] += (t − t0, 1)`.
3. `getAverageTime(s, e)`: `total / count` for that route.

First example: Paradise → Cambridge 14, Leyton → Waterloo 11, then 11 and 12 after another trip.

Do not store every trip and average on each query; running totals are O(1). Do not key routes without direction; A → B differs from B → A.

Time: O(1) per call  
Space: O(customers + routes)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
