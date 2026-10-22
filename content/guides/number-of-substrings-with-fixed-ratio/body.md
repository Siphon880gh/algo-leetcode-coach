A binary string s is given with two positive integers num1 and num2 that share no common factor. A substring is a ratio substring when its numbers of 0s and 1s are in the ratio num1 : num2. Count the non-empty ratio substrings. For instance, s = 0110 with num1 = num2 = 1 → 3 (01, 10 and 0110); s = 001 with num1 = 2 and num2 = 1 → 1. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Count equal prefix keys

1. `cnt = {0: 1}`, `p = 0`, `ans = 0`.
2. For each character: `p += num2` for a 0, `p −= num1` for a 1; `ans += cnt[p]`; `cnt[p]++`.
3. Return `ans`.

Constructed checks (verified against testing every substring on 400 random strings and ratios): the cases above → 3, 1.

Two prefixes with the same key differ by a substring whose zeros and ones satisfy z · num2 = o · num1, and a non-empty one needs both counts positive since num1 and num2 are positive. The count grows quadratically with the length, so keep it in 64-bit for long strings.

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
