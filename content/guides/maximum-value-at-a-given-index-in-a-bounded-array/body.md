## Mountain cost

`side(v, c)` = cheapest sum of `c` cells next to a peak `v`:

- if `v − 1 ≥ c`: `(v − 1 + v − c) · c / 2`;
- else: `(v − 1) · v / 2 + (c − (v − 1))` (the tail stays at 1).

Find the largest `v` with `v + side(v, index) + side(v, n − 1 − index) ≤ maxSum`.

`n = 4, index = 2, maxSum = 6` → 2. `n = 6, index = 1, maxSum = 10` → 3. Constructed: `n = 1, maxSum = 10` → 10.

Search up to `maxSum`, using 64-bit arithmetic for the series. Do not let values drop below 1.

Time: O(log maxSum)  
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
