## Consume values while they fit

`i = 0`.

`build(bound)`:

1. If `i == n` or `preorder[i] > bound`, return null.
2. `root = Node(preorder[i])`, `i += 1`.
3. `root.left = build(root.val)`.
4. `root.right = build(bound)`.
5. Return `root`.

Call `build(∞)`.

Every value is consumed once, and the bound tells each call where its subtree ends.

A monotonic stack works too: for each value, pop while the stack top is smaller. If anything was popped, attach the value as the right child of the last popped node; otherwise attach it as the left child of the top. Then push it.

Do not insert each value from the root; that is O(n²) on a sorted input. Do not search for the split point linearly in every call; that is also O(n²) in the worst case.

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
