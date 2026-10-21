## Run-building DP

1. If `n − i ≤ k`, return 0.
2. Option A: `f(i + 1, k − 1)` (delete s[i]).
3. Option B: for `j ≥ i`, count `same` (== s[i]) and `diff`; stop when `diff > k`; candidate `len(same) + f(j + 1, k − diff)`, where `len(c)` = 1, 2, 3, or 4 for c = 1, 2–9, 10–99, or 100.

`"aaabcccd"`, 2 → 4. `"aabbaa"`, 2 → 2. `"aaaaaaaaaaa"`, 0 → 3.

Do not greedily delete the rarest characters; deleting a separator can merge two runs (as in `"aabbaa"`). Remember that a count of 1 is written without a digit.

Time: O(n² · k)  
Space: O(n · k)

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
