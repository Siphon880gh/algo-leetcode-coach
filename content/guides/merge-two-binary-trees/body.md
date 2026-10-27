## Overlap adds, the rest is reused

`merge(a, b)`:

- If `a` is null, return `b`; if `b` is null, return `a`.
- Otherwise make a node with `a.val + b.val` (or reuse `a`), set `left = merge(a.left, b.left)` and `right = merge(a.right, b.right)`, and return it.

Where only one tree has a subtree, that subtree is attached as it is, so the work is proportional to the overlap. A BFS over node pairs gives the same result without recursion.

Do not keep descending when one side is null; returning the other subtree right away is both simpler and faster. Do not add null values as 0 and create new nodes for the non-overlapping parts; it works, but it copies subtrees for no reason.

Time: O(min(n1, n2))  
Space: O(min(h1, h2)) recursion

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
