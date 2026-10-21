## Split by the left subtree size

Map each value to its index in `postorder`.

`build(a, b, c)` builds the tree whose preorder is `pre[a..b]` and whose postorder starts at `c`:

1. If `a > b`, return null. Create `root = pre[a]`. If `a == b`, return it.
2. The left root is `pre[a + 1]`. Its postorder index `p` gives the left size `L = p − c + 1`.
3. `root.left = build(a + 1, a + L, c)`.
4. `root.right = build(a + L + 1, b, c + L)`.

When a node has one child, preorder and postorder cannot tell left from right; treating it as a left child is a valid answer.

Do not search postorder linearly at each step; that is O(n²) on a skewed tree. Do not slice arrays in every call if you want O(n).

Time: O(n)  
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
