## Let the voyage pick the next child

`i = 0`, `flips = []`.

`dfs(node)`:

1. If null, return true.
2. If `node.val != voyage[i]`, return false. Else `i += 1`.
3. If `node.left` exists and `node.left.val != voyage[i]`: record `node.val` in `flips`, then return `dfs(node.right) and dfs(node.left)`.
4. Otherwise return `dfs(node.left) and dfs(node.right)`.

Return `flips` if `dfs(root)` succeeded, else `[−1]`.

Values are unique, so the next voyage value names exactly one child; there is never a real choice.

Do not flip a node whose left child is missing; flipping changes nothing there. Do not keep going after a mismatch.

Time: O(n)  
Space: O(h)

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
