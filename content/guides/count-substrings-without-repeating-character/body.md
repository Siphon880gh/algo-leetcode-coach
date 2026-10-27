Given a string of lowercase letters, count its substrings in which no letter appears more than once. The exact limits are in the official statement. For instance, abcd → 10, aa → 2 and abca → 9. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Window per end

1. `l = 0`, `last` = latest index of each letter.
2. For each r: if `last[s[r]] ≥ l`, set `l = last[s[r]] + 1`; set `last[s[r]] = r`; add `r − l + 1`.
3. Return the sum.

Constructed checks: the examples above → 10, 2, 9. Checked against testing every substring on 300 random strings.

Count positions, not distinct texts: in aa both single-letter substrings count, so the answer is 2, not 1. Each right end adds at most 26, since a window without repeats holds at most 26 letters.

Time: O(n)  
Space: O(alphabet)

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
