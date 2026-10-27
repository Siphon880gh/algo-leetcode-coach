## Decide from below

`prune(node, s)` where `s` is the sum above `node`:

1. `s += node.val`.
2. If `node` is a leaf, return `node` if `s ≥ limit`, else null.
3. `node.left = prune(node.left, s)` if it exists; same for `node.right`.
4. Return null if both children are now null, else `node`.

Answer: `prune(root, 0)`.

An inner node with no surviving child has no root-to-leaf path through it that reaches `limit`.

Do not treat a node that lost its children as a new leaf and test its own sum; its original paths all failed. Do not test inner nodes against `limit` directly; only full paths count.

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
