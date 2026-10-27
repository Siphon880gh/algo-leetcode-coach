## Complement count

1. Runs L1 … Lm; total = Π Li mod 10^9 + 7. If m ≥ k, answer total.
2. dp[s] = ways to pick lengths for the runs so far with sum s < k; each run adds 1 … Li, done with prefix sums.
3. Answer total − Σ dp[s].

Examples → 5, 1, 8. Checked against every choice on 300 random cases.

Not subtracting short strings: example 1 → 16 instead of 5.

Time: O(n + k²)  
Space: O(k)

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
