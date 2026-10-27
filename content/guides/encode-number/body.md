The statement defines a secret encoding of non-negative integers as binary strings through a table of examples. Return the encoding of `num`. The pattern in that table is: write `num + 1` in binary and drop its leading 1, so 0 → `""`, 1 → `"0"`, 2 → `"1"`, 3 → `"00"`. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Shift by one

Return `bin(num + 1)[3:]` (Python adds `0b1` before the remaining bits).

There are `2ᵏ` strings of length `k`, and the numbers `2ᵏ − 1 … 2ᵏ⁺¹ − 2` get them in order. Adding 1 maps that range to `2ᵏ … 2ᵏ⁺¹ − 1`, whose binary forms are `1` followed by exactly those `k` bits.

`23` → `24 = 11000₂` → `"1000"`. `107` → `108 = 1101100₂` → `"101100"`.

Do not convert `num` itself; the lengths would be off by one. Check the table in the statement if you are unsure the pattern matches.

Time: O(log num)  
Space: O(log num)

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
