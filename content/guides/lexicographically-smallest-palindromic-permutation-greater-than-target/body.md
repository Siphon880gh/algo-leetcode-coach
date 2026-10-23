## Halves

1. If more than n % 2 letters have odd counts, return "". m = the odd letter (if any); half = each count // 2; k = n // 2.
2. If target[:k] uses exactly half: p = target[:k] + m + reverse(target[:k]). If p > target, return p.
3. Else find the smallest permutation of half that is > target[:k] (keep a prefix, raise one letter, sort the rest). Mirror it, or return "" if none.

Examples → "baab", "", "", "aca". Checked against listing every palindromic permutation on 2,000 random cases.

Skipping step 2: constructed check (run in code) s = "b", target = "a" → "" instead of "b".

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
