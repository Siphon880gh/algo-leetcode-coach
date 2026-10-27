Each node has a parent pointer. Given two nodes p and q of the same tree (no root given), return their lowest common ancestor. For instance, in [3,5,1,6,2,0,8], LCA(6, 2) = 5 and LCA(6, 1) = 3. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Linked-list intersection

1. `a = p`, `b = q`.
2. While `a ≠ b`: `a = a.parent if a else q`; `b = b.parent if b else p`.
3. Return `a`.

Constructed check: `[3,5,1,6,2,0,8]`: (6, 2) → 5; (6, 1) → 3; (5, 6) → 5.

Both pointers walk depth(p) + depth(q) steps, so they align. A hash set of p's ancestors also works with O(h) space.

Time: O(h)  
Space: O(1)

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
