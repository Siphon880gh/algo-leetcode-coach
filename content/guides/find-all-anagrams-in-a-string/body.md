## Window of exactly |p| letters

Count `p` into a 26-slot array `need`. Slide a window of length `|p|` over `s` with its own 26 counts `have`. Each step: add `s[i]`; once the window is full, compare `have` with `need` and record `i − |p| + 1` on a match; then remove the leftmost letter `s[i − |p| + 1]`. A 26-way comparison per step is constant work. To shave it further, track how many of the 26 letters currently differ and update that counter as letters enter and leave.

Permutation in String (567) asks whether any such window exists. Valid Anagram (242) compares two whole strings. Minimum Window Substring (76) has a variable-size window and allows extra letters.

Do not sort every window (O(n · |p| log |p|)). Do not grow or shrink the window — every anagram has exactly `|p|` letters. Do not forget the early return when `s` is shorter than `p`.

Time: O(|s| + |p|) (times 26 if you compare whole arrays)  
Space: O(1) — two arrays of 26

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
