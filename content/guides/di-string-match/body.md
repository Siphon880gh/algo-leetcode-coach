## Extremes are always safe

`lo = 0`, `hi = n`. For each character:

- `'I'`: append `lo`, `lo += 1`. Everything still available is larger, so the next value rises.
- `'D'`: append `hi`, `hi −= 1`. Everything still available is smaller, so the next value falls.

Finally append `lo` (now `lo == hi`).

Return the list.

Do not search permutations; any valid answer is accepted, and this one is built directly. Do not forget the last element; the result has `n + 1` values.

Time: O(n)  
Space: O(n) for the result

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
