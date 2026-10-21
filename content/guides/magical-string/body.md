## Read and write pointers on the same string

Start with `s = [1, 2, 2]`. Groups alternate between 1s and 2s. The read pointer `i = 2` says how long the next group is. Repeatedly: the next digit is `3 − s[-1]` (the other digit); append it `s[i]` times; `i += 1`. Stop once `len(s) >= n`, then count the 1s in `s[:n]`. The write end always stays ahead of `i`, because every group has length at least 1.

Count and Say (38) also reads groups to make the next term, but it builds a new string each round. This one grows a single string from its own description.

Do not start with only `[1]` and generic rules — the first group `1` and the second group `22` overlap the self-description, so seed `122`. Do not count past `n` (the last group may overshoot by one).

Time: O(n)  
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
