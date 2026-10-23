## Three prefix arrays

1. h = value of non-zero digits so far (mod 10^9 + 7); c = count of non-zero digits; sm = digit sum.
2. Query [l, r]: x = h[r + 1] − h[l] · 10^(c[r + 1] − c[l]) mod p.
3. Answer x · (sm[r + 1] − sm[l]) mod p.

Examples → [12340, 4, 9], [1, 0], [444444137]. Checked against building each substring on 2,000 random cases.

Shifting by the full range length (zeros included): example 1, query [1, 3] → 999998031 instead of 4.

Time: O(m + q log p)  
Space: O(m)

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
