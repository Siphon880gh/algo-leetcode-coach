## At most 36 candidates

1. For length `L` from `len(str(low))` to `len(str(high))`:
2. For each start `i` from 0 to `9 − L`: `x = int("123456789"[i : i + L])`; keep it if `low ≤ x ≤ high`.

Generating by length, then by start, already yields increasing order.

`100..300` → `[123,234]`. `1000..13000` → `[1234,2345,3456,4567,5678,6789,12345]`.

Do not loop over every integer in the range; it can be about 10⁹ wide. Do not sort afterwards if you generate in this order; it is already sorted.

Time: O(1) (at most 36 numbers)  
Space: O(1)

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
