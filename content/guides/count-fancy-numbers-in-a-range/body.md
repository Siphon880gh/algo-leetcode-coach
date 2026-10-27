## F(N)

1. GOOD = every strictly monotone number; GS = good values up to 144 (the largest digit sum).
2. A = count of x in [1, N] with digit sum in GS (digit DP over position, sum, tight).
3. B = good numbers ≤ N; C = good numbers ≤ N whose digit sum is also good.
4. F(N) = A + B − C; return F(r) − F(l − 1).

Examples → 3, 1, 0. Checked against a direct scan on 300 random ranges up to 3,000.

Counting only good numbers: example 2 → 0 instead of 1.

Time: O(16 · 145 · 10 + 1,525)  
Space: O(16 · 145)

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
