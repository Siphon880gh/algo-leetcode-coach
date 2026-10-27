## Parity greedy

1. s = Σ max(x, x ⊕ k); c = number of x with x ⊕ k > x.
2. If c is odd, s −= min over all x of |(x ⊕ k) − x|.

Examples → 6, 9, 42. Checked against exploring every reachable state on 400 random small trees.

Each operation flips two nodes, so the number of flipped nodes is always even: ignoring parity gives nums = [1, 1, 1], k = 2 (a star) → 9 instead of 7. The tree shape never matters.

Time: O(n)  
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
