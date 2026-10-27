## The stack is the path from the root

Read the string as pairs `(depth, value)`: count dashes, then read digits.

For each pair:

1. Pop until `len(stack) == depth`.
2. If the stack is non-empty, attach the node to `stack[-1]`: as `left` if that is empty, else as `right`.
3. Push the node.

Return `stack[0]`.

Preorder visits a node's left child first, so the left slot fills before the right.

Do not parse values as single characters; values can have several digits. Do not recurse with string slicing; one pointer through the string keeps it linear.

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
