## State

1. f(u, d, p): best sum of u’s subtree, d = edges up to the nearest inverted ancestor (k if none or farther), p = parity of inversions above u.
2. Not inverting: sign(p) · nums[u] + Σ f(child, min(d + 1, k), p).
3. Inverting (only if d ≥ k): sign(p ⊕ 1) · nums[u] + Σ f(child, 1, p ⊕ 1).
4. Answer f(0, k, 0).

Examples → 27, 9, 3. Checked against trying every allowed set of inversions on 300 random trees.

Ignoring the distance rule: example 2 → 15 instead of 9.

Time: O(n · k)  
Space: O(n · k)

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
