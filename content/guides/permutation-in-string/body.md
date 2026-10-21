## Fixed window of counts

Let `m = len(s1)`. Any permutation of `s1` is a substring of `s2` with exactly `m` letters and the same counts, so slide a window of length `m` over `s2`.

Keep `cnt` = letter counts of `s1` and `need` = how many letters are still unmatched:

1. Character `c` enters: `cnt[c] -= 1`; if it reaches 0, `need -= 1`.
2. Once `i >= m`, character `s2[i − m]` leaves: `cnt[...] += 1`; if it becomes 1, `need += 1`.
3. If `need == 0`, return true.

Comparing two 26-slot arrays at every step also works, at O(26 · n).

Find All Anagrams in a String (438) uses the same window and collects every start.

Do not sort each window; that costs O(n · m log m). Do not let the window grow or shrink, because a permutation has exactly `m` letters.

Time: O(m + n)  
Space: O(1) (26 letters)

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
