Design a sparse vector class built from an integer array that supports a dot product with another sparse vector, as the statement specifies. For instance, `[1,0,0,2,3]` · `[0,3,0,4,0]` = 8. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Non-zero pairs

1. Constructor: keep `[(i, v) for v ≠ 0]` (sorted by i).
2. `dotProduct(other)`: two pointers; on equal indices add `v1 · v2`.

`[1,0,0,2,3]` · `[0,3,0,4,0]` = 2 · 4 = 8.

Do not store the dense array if most entries are zero. If one vector is much sparser, binary search its indices in the other.

Time: O(k1 + k2) per product  
Space: O(k)

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
