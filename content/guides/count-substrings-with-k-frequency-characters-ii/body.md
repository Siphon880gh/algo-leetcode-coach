Given a string s and an integer k, count the substrings in which at least one character appears at least k times. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Count valid starts

This assumes the task is part I’s with a much longer string, so only a linear pass fits.

1. Add s[r]; while count[s[r]] ≥ k, drop s[l] and l += 1.
2. ans += l (use 64-bit; the count grows like n²/2).

Constructed checks (run in code): abacb, k = 2 → 4; aaa, k = 2 → 3. Checked against every substring on 300 random cases.

Counting only characters that appear exactly k times: aaa, k = 2 → 2 instead of 3.

Time: O(n)  
Space: O(26)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
