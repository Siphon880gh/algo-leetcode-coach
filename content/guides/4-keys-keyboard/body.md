A keyboard has four keys: `A` (type one A), `Ctrl-A` (select all), `Ctrl-C` (copy the selection) and `Ctrl-V` (paste the clipboard after what is on screen). Given `n` presses (up to 50), return the most A's you can have on screen. `n = 3` → 3 (type A three times). `n = 7` → 9 (A, A, A, Ctrl-A, Ctrl-C, Ctrl-V, Ctrl-V). _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## The last copy decides

`dp[i]` = most A's after `i` presses, with `dp[i] = i` for small `i`.

For each `i`, either:

- the last press types an A: `dp[i − 1] + 1`, or
- at press `j` the screen had `dp[j]` A's, then you pressed Ctrl-A and Ctrl-C (presses `j + 1`, `j + 2`) and Ctrl-V on every press after that. That leaves `i − j − 2` pastes, so the screen holds `dp[j] · (i − j − 1)`.

`dp[i] = max(dp[i − 1] + 1, max over j ≤ i − 3 of dp[j] · (i − j − 1))`.

It is never worth pasting more than about 5 times in a row before copying again, so `j` only needs to go back a few steps, but checking every `j` is cheap at `n ≤ 50`.

Do not forget the two presses spent on Ctrl-A and Ctrl-C. Do not assume the best plan always copies; for `n ≤ 6`, typing A each time is as good or better.

Time: O(n²)  
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
