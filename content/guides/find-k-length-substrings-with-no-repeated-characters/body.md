Given a string `s` and an integer `k`, return how many substrings of length `k` contain no repeated characters. `s = "havefunonleetcode"`, `k = 5` → 6. `s = "home"`, `k = 5` → 0. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Window of distinct letters

If `k > 26`, return 0 (only 26 letters). `cnt` = letter counts, `left = 0`, `ans = 0`. For each `right`:

1. `cnt[s[right]] += 1`.
2. While `cnt[s[right]] > 1` or `right − left + 1 > k`: `cnt[s[left]] −= 1`; `left += 1`.
3. If `right − left + 1 == k`, `ans += 1`.

Return `ans`.

Do not rebuild a set for every window; that is O(n · k). Do not forget the `k > 26` shortcut; no such window exists.

Time: O(n)  
Space: O(26)

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
