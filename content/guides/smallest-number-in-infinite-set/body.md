## Two parts of the set

1. `cur = 1`, empty min-heap `h`, empty set `inH`.
2. `popSmallest()`: if `h` is non-empty, pop its minimum and remove it from `inH`; else return `cur` and increase `cur`.
3. `addBack(x)`: if `x < cur` and `x ∉ inH`, push it.

Example → null, null, 1, 2, 3, null, 1, 4, 5.

Every added-back number is below `cur`, so the heap’s minimum is always smaller than `cur`. Numbers ≥ `cur` are still present, so adding them back changes nothing.

Time: O(log k) per call, k = numbers in the heap  
Space: O(k)

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
