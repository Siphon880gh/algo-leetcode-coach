## Nulls must come last

1. Queue starts with the root; `seenNull = false`.
2. Pop `node`:
   - If `node` is null, set `seenNull = true`.
   - Else if `seenNull`, return false (a node after a gap).
   - Else enqueue `node.left` and `node.right` (even if null).
3. Return true.

Level order lists positions left to right, level by level, which is exactly the order a complete tree fills.

An index check also works: number nodes 1, 2, 3, … like a heap; the tree is complete when the largest index equals the node count.

Do not check only that the last level is filled left to right; a gap in an earlier level also breaks completeness. Do not skip enqueueing nulls; they mark the gaps.

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
