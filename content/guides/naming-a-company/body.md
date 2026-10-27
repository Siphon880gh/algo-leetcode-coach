## 26 · 25 / 2 letter pairs

1. `S[x]` = set of suffixes of names starting with `x`.
2. For each pair `x < y`: `c = |S[x] ∩ S[y]|`; `ans += 2 · (|S[x]| − c) · (|S[y]| − c)`.

Examples → 6, 0. Checked against testing every ordered pair on 200 random lists.

A swap is invalid exactly when either new name already exists, which happens when the suffix is shared by both letters; names with the same first letter swap into themselves. With 5 · 10^4 names the answer can exceed 32-bit.

Time: O(26² · L + Σ |w|), L the largest group  
Space: O(Σ |w|)

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
