## DP

1. h starts as all 1 (empty target).
2. For each target character c: new h[a][b] = Σ h[p][b] over p < a with word1[p] = c, plus Σ h[a][q] over q < b with word2[q] = c, using running sums along a and along b.
3. Answer = h[A][B] − (subsequence count of target in word1) − (in word2), mod 10^9 + 7.

Examples → 5, 4, 2, 1. Checked against enumerating every choice on 1,500 random cases; 100-letter strings of one letter run in under a second in Python.

Not removing the one-string ways: example 1 → 6 instead of 5.

Time: O(T · A · B)  
Space: O(A · B)

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
