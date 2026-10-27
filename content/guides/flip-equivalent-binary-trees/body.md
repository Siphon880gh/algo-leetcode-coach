## Two ways to line up the children

`eq(a, b)`:

- Both null → true.
- One null, or `a.val != b.val` → false.
- Otherwise → `(eq(a.left, b.left) and eq(a.right, b.right)) or (eq(a.left, b.right) and eq(a.right, b.left))`.

Values are unique, so at most one of the two pairings can match beyond the first level, which keeps the work linear.

A canonical form also works: at every node, put the child with the smaller value (or null) on the left, then compare the trees directly.

Do not flip only at the root. Do not compare the sets of values; shapes matter.

Time: O(n) with unique values  
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
