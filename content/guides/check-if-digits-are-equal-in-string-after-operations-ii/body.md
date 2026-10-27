## Pascal weights

1. m = n − 2. For each i ≤ m: c2 = C(m, i) mod 2 (1 exactly when i & m = i); c5 = product of C(a, b) over base-5 digits (0 if some b > a).
2. c = the digit 0–9 with c ≡ c2 (mod 2) and c ≡ c5 (mod 5).
3. x = Σ c · s[i], y = Σ c · s[i + 1], both mod 10. Answer x = y.

Examples → true, false. Checked against direct simulation on 2,000 random strings.

Updating C(m, i + 1) = C(m, i) · (m − i) / (i + 1) with every value kept mod 10: 3792339 → false instead of true.

Time: O(n log n)  
Space: O(n)

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
