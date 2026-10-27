`chars` has 1 to 2000 characters (letters, digits, symbols). For each run of equal characters, write the character, then the run length if it is more than 1. A length like 12 is written as two characters `'1'`, `'2'`. Do it in place with O(1) extra space and return the new length. `["a","a","b","b","c","c","c"]` → 6 (`a2b2c3`). `["a"]` → 1. `["a","b"×12]` → 4 (`ab12`).

## Read the run, write char then digits

Keep `i` (read) and `k` (write). From `i`, advance `j` while `chars[j] == chars[i]`. Write `chars[k++] = chars[i]`. If `j − i > 1`, write each digit of `str(j − i)`. Set `i = j` and repeat. Return `k`.

The write pointer never passes the read pointer: a run of length `L >= 2` takes at most `1 + digits(L) <= L` slots, and a run of 1 takes 1 slot. So overwriting is safe.

Count and Say (38) builds a new string from counts. Encode and Decode Strings (271) adds length prefixes for arbitrary strings.

Do not write a count of 1. Do not write a multi-digit count as one character. Do not build a new string and copy it back — that is O(n) extra space.

Time: O(n)  
Space: O(1)

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
