## Bump and fill

1. For `i = n − 1 … 0`: try letters c from `s[i] + 1` to the k-th letter, skipping `s[i − 1]` and `s[i − 2]`.
2. On the first success set `s[i] = c`; for each `j > i`, set the smallest letter different from `s[j − 1]` and `s[j − 2]`; return s.
3. No position works → "".

Examples → abda, the empty string. Checked against listing every beautiful string for k = 4, 5 and n ≤ 5.

Any palindrome of length 2 or more contains one of length 2 or 3 at its centre, so checking the two previous letters is enough. With k ≥ 4 a filling letter always exists.

Time: O(n · k)  
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
