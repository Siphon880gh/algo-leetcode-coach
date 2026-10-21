## Column addition in base −2

Both arrays are most significant digit first. Walk `i` and `j` from the ends with `carry = 0`; continue while either has digits or `carry != 0`:

- `s = a[i] + b[j] + carry` (use 0 past an end); `s` lies in [−1, 3].
- `digit = s & 1`; `carry = −(s − digit) // 2`.
- Append `digit`.

Reverse, then strip leading zeros, keeping at least one digit.

Check: `s = 2` gives digit 0, carry −1; `s = −1` gives digit 1, carry 1.

Do not convert to integers and back; the arrays can be 1000 digits long. Do not use a positive carry; a column worth `2 · (−2)^k` equals `−1 · (−2)^(k+1)`.

Time: O(m + n)  
Space: O(m + n)

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
