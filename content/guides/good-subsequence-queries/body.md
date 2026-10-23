## After each update

1. G = gcd of the multiples of p; cnt = number of them.
2. G ≠ p → no.
3. cnt < n → yes.
4. All n are multiples: n ≥ 8 → yes; else check each subsequence leaving one element out.

Why 8: divide by p so the gcd is 1. One value below 5 · 10^4 has at most 6 prime factors, and each needs one other value without it, so 7 values already have gcd 1.

Examples → 1, 2, 0. Checked against every subsequence on 4,000 random arrays.

Allowing the whole array: constructed check (run in code) [2, 3], p = 1, query [0, 2] → 1 instead of 0.

Time: O((n + q) log n · log V)  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
