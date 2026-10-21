## Biggest first, respecting caps

1. Sort the pairs `(value, label)` by value, descending.
2. `used = {}`, `taken = 0`, `total = 0`. For each pair: stop if `taken == numWanted`; if `used[label] < useLimit`, add `value`, increment `used[label]` and `taken`.
3. Return `total`.

Skipping a capped item never hurts: any later item with that label is capped too, and other labels are unaffected.

Do not stop at the first capped item; smaller items with other labels may still fit. Do not treat numWanted as an exact count; fewer items are fine when the caps run out.

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
