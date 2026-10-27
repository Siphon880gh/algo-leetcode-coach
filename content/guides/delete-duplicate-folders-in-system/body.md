## Signature per folder

1. Insert every path into a trie.
2. Post-order: `sig(node) = concat(name + "(" + sig(child) + ")")` over sorted children; leaves get `""`. Count signatures of non-empty nodes.
3. Pre-order from the root: skip a child (and its subtree) if its signature count > 1; otherwise output its path.

Example 1 → `[d], [d,a]`. Example 2 → `[a], [a,b], [c], [c,b]`. Example 3 → all four paths.

Empty folders are never identical (the set must be non-empty), so leaves are excluded from counting. Mark from the original tree only: deletion happens once.

Time: O(total path length · log) for sorting children  
Space: O(total path length)

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
