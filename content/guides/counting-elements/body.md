Given an integer array, count the elements x for which x + 1 is also in the array. Duplicates are counted separately. For instance, `[1,2,3]` gives 2, and `[1,1,2]` gives 2 (both 1s count). _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Set lookup

1. `S = set(arr)`.
2. Return `Σ [x + 1 ∈ S]` over all elements, duplicates included.

`[1,2,3]` → 2. `[1,1,2]` → 2. `[1,3,5]` → 0.

Do not count distinct values only; each copy counts. Do not sort and compare neighbours without care for duplicates; the set is simpler.

Time: O(n)  
Space: O(n)

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
